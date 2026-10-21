## Remember what is waiting on the right

`f(i, j)` alone is not enough: the best move inside depends on how many boxes of `boxes[j]`'s color will join it from outside. Define `dfs(i, j, k)` = the best score for `boxes[i..j]` when `k` boxes with the color of `boxes[j]` are attached right after `j`.

- First absorb equal neighbors: while `j > i` and `boxes[j − 1] == boxes[j]`, do `j −= 1, k += 1`.
- Option 1: remove `boxes[j]` with its `k` partners now: `dfs(i, j − 1, 0) + (k + 1)²`.
- Option 2: for each `h` in `[i, j − 1]` with `boxes[h] == boxes[j]`, clear the middle first so `h` joins the group: `dfs(h + 1, j − 1, 0) + dfs(i, h, k + 1)`.

Memoize on `(i, j, k)`; `dfs(i, j, k) = 0` when `i > j`. Answer `dfs(0, n − 1, 0)`.

In the example, removing the 2s first lets three 3s join (9 points), and the two 1s join at the end (4).

Do not greedily remove the largest group first. Do not drop `k` from the state — two calls on the same interval can need different answers.

Time: O(n⁴) worst case (O(n³) states, O(n) each)  
Space: O(n³)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Algo Learning IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
