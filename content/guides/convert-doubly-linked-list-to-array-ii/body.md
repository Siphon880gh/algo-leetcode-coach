You are given some node of a doubly linked list (each node has next and previous pointers), not necessarily the head. Return the list’s values from head to tail. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Back, then forward

1. While node.prev exists, move to node.prev.
2. Walk next from there, appending each value.

Constructed checks (run in code): list 3 ⇄ 1 ⇄ 4 ⇄ 2 given the node holding 4 → [3, 1, 4, 2]; a single node 7 → [7].

Walking next from the given node only: the first check → [4, 2].

Time: O(n)  
Space: O(1) beyond the output

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
