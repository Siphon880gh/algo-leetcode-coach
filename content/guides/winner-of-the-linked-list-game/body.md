You are given the head of a linked list with an even number of nodes. The nodes form consecutive pairs: first and second, third and fourth, and so on. In each pair, the node with the higher value earns a point for its team: one team owns the first node of every pair, the other team the second. Return which team has more points, or that it is a tie, using the labels the statement gives. Limits are in the official statement. For instance, values 2, 5, 4, 7, 20, 5 → the team of second nodes wins, 2 points to 1. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Pairwise walk

This assumes values within a pair differ or that equal values score for neither team; check the official statement.

1. a = b = 0. While the node exists: if node.val > node.next.val, a += 1; else if smaller, b += 1. Move two nodes on.
2. Return the first team’s label if a > b, the second’s if b > a, else the tie label.

Constructed checks (run in code): the example above; 2, 1 → first team; 4, 5, 2, 1 → tie.

Step two nodes at a time: moving one node at a time also compares 5 with 4 across pairs.

Time: O(n)  
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
