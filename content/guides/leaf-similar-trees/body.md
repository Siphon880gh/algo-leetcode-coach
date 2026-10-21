## Same leaves, same order

`leaves(node, out)`:

- If `node` is null, return.
- If it has no children, append `node.val`.
- Otherwise recurse left, then right.

Return `leaves(root1) == leaves(root2)`.

Visiting left before right gives the left-to-right order. The internal shape of the two trees does not matter.

For O(h) extra space, run two iterative DFS stacks side by side and compare leaves as they come out.

Do not compare the sets or sorted lists of leaves; order matters. Do not treat a node with one child as a leaf.

Time: O(n₁ + n₂)  
Space: O(n₁ + n₂) for the lists

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
