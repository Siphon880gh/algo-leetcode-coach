## Walk the denary trie without building it

Picture a 10-ary tree: the children of prefix `p` are `p·10` through `p·10 + 9`. A preorder walk visits numbers in lexicographic order. Building it is impossible for `n = 1e9`, so count instead.

`count(cur)` = how many numbers in `[1, n]` start with `cur`. Walk levels: `first = cur`, `last = cur + 1` (exclusive). Each level adds `min(n + 1, last) − first` while `first <= n`, then `first *= 10`, `last *= 10`. Use 64-bit math because `last` grows past `n`.

Start at `cur = 1` and set `k −= 1` (you are standing on the first number). While `k > 0`: let `c = count(cur)`. If `k >= c`, the answer is not under `cur`: `k −= c`, `cur += 1` (next sibling). Otherwise the answer is inside: `k −= 1`, `cur *= 10` (first child). Return `cur`.

Lexicographical Numbers (386) lists all of `[1, n]` in this order with a preorder DFS — fine for `n <= 5e4`, far too slow here.

Do not generate and sort strings. Do not step one number at a time with the 386 walk (up to 1e9 steps). Do not forget the `k −= 1` when you step into a child — the child itself is one number.

Time: O(log² n) — up to about 10 · log n moves, each counting log n levels  
Space: O(1)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
