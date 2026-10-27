## Prune at the first larger value

Each node is either a leaf or has two children, and it equals the smaller of the two. So the root is the global minimum, and values never decrease going down.

DFS from the root with `best = ∞`:

- If `node.val > root.val`, update `best = min(best, node.val)` and do **not** go below it; everything below is at least as large.
- Otherwise (`node.val == root.val`), recurse into both children.

Return `best`, or `-1` if it is still `∞`.

Do not assume the answer is one of the root's children; in `[2,2,2,2,5]` both children are 2, and the answer 5 sits one level lower. Do not use a sentinel like `INT_MAX` for "none" if values can reach it; use null or ∞.

Time: O(n)  
Space: O(h)

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
