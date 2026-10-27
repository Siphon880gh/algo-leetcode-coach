## Exactly one top

1. Collect all leaf values; the final root = the unique tree whose root value is not among them (none or several → null).
2. Map remaining root values to their trees.
3. DFS with bounds `(lo, hi)`: a node must satisfy `lo < v < hi`; a leaf whose value is a remaining root takes that tree's children (remove it from the map).
4. Succeed only if the DFS passes and the map is empty.

Example 1 → `[3,2,5,1,null,4]`. Example 2 → null. Example 3 → null.

Leaf values are unique among leaves in a valid answer, so each root attaches at most once. Bound checks catch cases like example 2, where 6 lands left of 5.

Time: O(total nodes)  
Space: O(total nodes)

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
