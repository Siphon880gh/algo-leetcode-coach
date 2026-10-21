## Distinct-digit numbers are easy to count

Let `s = str(n)`, `L = len(s)`, and `P(m, r) = m! / (m − r)!`.

1. Lengths `1 … L − 1`: `9 · P(9, len − 1)` each (no leading zero).
2. Length `L`, digit by digit with a set `used`:
   - At position `i`, for each digit `d` from (1 if `i == 0` else 0) up to `s[i] − 1` not in `used`: add `P(10 − i − 1, L − i − 1)`.
   - If `s[i]` is in `used`, stop. Otherwise add it to `used`.
3. If the loop finished without a repeat, add 1 (n itself has distinct digits).

Answer: `n − distinct`.

Do not count repeated-digit numbers directly; the complement is much simpler. Do not allow 0 as the first digit.

Time: O(L · 10)  
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
