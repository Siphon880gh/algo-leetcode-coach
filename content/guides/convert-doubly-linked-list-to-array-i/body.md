Given the head of a doubly linked list, return its values in order as an array. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## One walk

1. While node: append node.val; node = node.next.

Constructed checks (run in code): 1 ↔ 2 ↔ 3 → [1, 2, 3]; a single node 5 → [5].

Following prev from the head stops at once: 1 ↔ 2 ↔ 3 → [1].

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
