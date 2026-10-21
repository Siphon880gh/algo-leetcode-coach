## Three running values

1. `C = min(#2s, #5s)` in the factorizations of `left … right`.
2. For each `i`, strip up to the remaining twos and fives (out of `C` each), then:
   - `exact *= x` while it stays below `10^10` (once it reaches that, it stays there);
   - `suf = suf · x mod 10^5`;
   - `pre *= x`, dividing by 10 while `pre ≥ 10^12`.
3. Small → `exact + "e" + C`. Large → first 5 digits of `pre`, `...`, `suf` padded to 5, `e`, C.

Examples → `24e0`, `399168e2`, `7219856259e3`. Checked against exact big-integer products on 150 random ranges and on 1 … 10000.

Removing the zero-making factor pairs first makes the remaining product only grow, so the 10-digit test is safe at any point. A double keeps about 15 significant digits, enough for the first 5.

Time: O(right − left)  
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
