## Heap positions per level

BFS with `(node, pos)` pairs, starting from `(root, 0)`. For each level:

1. `first` = the position of the first node in the queue.
2. Pop every node of the level, pushing `(left, 2 · (pos − first))` and `(right, 2 · (pos − first) + 1)`.
3. Width = last `pos` − `first` + 1. Keep the maximum.

The positions count the null slots between nodes, which is exactly what width means here. Subtracting `first` on each level keeps the numbers from doubling past 64 bits on a deep, thin tree.

Do not count only the nodes on a level; the nulls between the two ends count too. Do not skip the renumbering in languages with fixed-size integers; a chain of 3000 nodes would overflow.

Time: O(n)  
Space: O(width)

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
