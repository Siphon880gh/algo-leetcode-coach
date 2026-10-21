## Count the gaps

1. `ones = count('1')`; if `ones % 3`, return 0.
2. If `ones == 0`, return `C(n − 1, 2)` mod 1e9+7.
3. Else with positions `p` of ones and `k = ones/3`: `(p[k] − p[k−1]) · (p[2k] − p[2k−1])`.

`"10101"` → 4. `"1001"` → 0. `"0000"` → 3.

Do not try all cut pairs (O(n²)). Use 64-bit for `C(n − 1, 2)` with n up to 10^5.

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
