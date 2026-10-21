## State includes the last direction

1. Queue `(0, False)`; visited set of `(pos, back)`.
2. Forward: `pos + a`. Backward (if not `back`): `pos − b` ≥ 0.
3. Skip forbidden positions and those beyond the bound `max(max(forbidden), x) + a + b`.
4. Return the depth at `x`, or −1.

`[14,4,18,1,15]`, 3, 15, 9 → 3. `[8,3,16,6,12,20]`, 15, 13, 11 → −1. `[1,6,2,14,5,17,4]`, 16, 9, 7 → 2.

Visiting a position once without the flag can miss paths; track both states. Without an upper bound BFS never ends.

Time: O(bound)  
Space: O(bound)

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
