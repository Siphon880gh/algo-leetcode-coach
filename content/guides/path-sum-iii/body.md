## Subarray Sum Equals K on the root path

Walk the tree with DFS and keep `s`, the sum from the root to the current node. A downward path ending here sums to `target` exactly when some ancestor prefix equals `s − target`. Keep a hash map `cnt` of prefix sums on the current root path, seeded with `cnt[0] = 1` (the empty prefix, so paths that start at the root count). At each node: add `cnt[s − target]` to the answer, then `cnt[s] += 1`, recurse into both children, and `cnt[s] −= 1` before returning so a sibling subtree never sees this branch.

Path Sum (112) and Path Sum II (113) only allow root-to-leaf paths. Subarray Sum Equals K (560) is the same prefix-count idea on an array.

Do not forget the undo step (counts would leak across branches). Do not forget `cnt[0] = 1`. Do not stop at the first match — keep counting below. In Java or C++, use 64-bit sums; values reach 1e9.

The brute force (start a DFS from every node) is O(n²) in a skewed tree.

Time: O(n)  
Space: O(h) recursion plus up to O(n) map entries

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
