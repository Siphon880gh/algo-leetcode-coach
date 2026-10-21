## Shrink the state

The buttons flip all bulbs, the even ones, the odd ones, and bulbs `3k + 1`. Each one repeats every 6 bulbs, and bulbs 4–6 are fixed by bulbs 1–3, so only `n' = min(n, 3)` bulbs matter. Pressing a button twice cancels out, so only the parity of each button counts.

The case table:

- `presses == 0` → 1.
- `n' == 1` → 2.
- `n' == 2` → 3 if `presses == 1`, else 4.
- `n' == 3` → 4 if `presses == 1`, 7 if `presses == 2`, else 8.

To avoid memorizing it, brute-force all 16 button-parity choices whose count is `≤ presses` and has the same parity as `presses`. Apply them to `n'` bulbs and count the distinct results.

Do not simulate press sequences; `presses` goes up to 1000. Do not treat every bulb as independent; there are at most 8 distinct states.

Time: O(1)  
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
