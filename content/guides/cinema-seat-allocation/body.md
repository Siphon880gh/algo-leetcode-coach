## Bitmask per reserved row

1. For reserved seats 2–9, set bits in `mask[row]`.
2. `ans = 2 · (n − rows with reservations)`.
3. For each such row: `k = [2–5 free] + [6–9 free]`; if `k == 0` and 4–7 is free, `k = 1`; add `k`.

`n = 3` example → 4. `n = 2` → 2. `n = 4` → 4.

Do not iterate over all `n` rows; `n` can be 10⁹. Do not count the middle block when the left or right block is already used; they overlap.

Time: O(reservations)  
Space: O(reserved rows)

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
