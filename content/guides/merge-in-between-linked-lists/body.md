## Two cut points

1. Walk to `prev` = node `a − 1` and `after` = node `b + 1`.
2. `prev.next = list2`; walk to list2's tail; `tail.next = after`.

`[10,1,13,6,9,5]`, a = 3, b = 4, list2 = 3 nodes → `[10,1,13,1000000,1000001,1000002,5]`. Example 2 → `[0,1,1000000,…,1000004,6]`.

`1 ≤ a` and `b < n − 1` guarantee both neighbours exist. Capture `after` before relinking.

Time: O(n + m)  
Space: O(1)

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
