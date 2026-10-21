## Bounce, replay, advance

`f[i]` = day of the first visit to room `i`; `f[0] = 0`.

1. On day `f[i − 1]` you are at `i − 1` for the first time (odd), so day `f[i − 1] + 1` is at `j = nextVisit[i − 1]`.
2. Getting from that first-style visit of `j` back to `i − 1` takes `f[i − 1] − f[j]` days (every room in `j..i−2` is reset to an even count, so the walk repeats).
3. The second visit to `i − 1` is even, so the next day is `i`: `f[i] = f[i − 1] + 1 + (f[i − 1] − f[j]) + 1`.
4. Return `f[n − 1]` mod 1e9+7 (add the modulus before reducing a negative).

Examples → 2, 6, 6. Checked against direct simulation on random inputs.

Since `nextVisit[i] ≤ i`, you can never skip ahead, so rooms are first reached in order and `f[n − 1]` is the answer.

Time: O(n)  
Space: O(n)

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
