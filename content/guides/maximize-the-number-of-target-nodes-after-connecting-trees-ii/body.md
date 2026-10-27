## Colour classes

1. BFS-colour both trees with 0 and 1; count each class.
2. answer[i] = size of i’s class in tree 1 + max(class sizes of tree 2).

Examples → [8, 7, 7, 8, 8], [3, 6, 6, 6, 6]. Checked against trying every connecting edge on 60 random tree pairs.

Always adding tree 2’s class of node 0: example 1 → [6, 5, 5, 6, 6].

Time: O(n + m)  
Space: O(n + m)

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
