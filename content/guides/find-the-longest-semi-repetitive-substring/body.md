## One pair allowed

1. `l = 0`, `last = −1` (second index of the latest equal pair).
2. For each r: if `s[r] = s[r − 1]`, then if `last ≥ 0` set `l = last`; set `last = r`.
3. Track the longest `r − l + 1`.

Examples → 4, 4, 2. Checked against testing every substring on 500 random strings.

Moving l to last drops exactly the older pair: the window then starts at that pair’s second digit, so only the new pair remains inside.

Time: O(n)  
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
