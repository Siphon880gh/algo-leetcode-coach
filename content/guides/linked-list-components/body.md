## Count the ends

A component is a maximal run of consecutive list nodes whose values are in `nums`. Every run has exactly one last node, so counting run ends counts the components.

`S = set(nums)`. For each node: if `node.val in S` and (`node.next` is null or `node.next.val not in S`), add 1.

Counting run starts works equally well (a node in `S` whose predecessor is not).

Do not count every node in `S`; adjacent ones belong to the same component. Do not sort `nums`; adjacency comes from the list order, not the values.

Time: O(n + |nums|)  
Space: O(|nums|)

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
