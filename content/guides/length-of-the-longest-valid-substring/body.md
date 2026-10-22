## Window with short checks

1. `F` = set(forbidden); `l = 0`.
2. For each r, for s from r down to `max(l, r − 9)`: if `word[s..r] ∈ F`, set `l = s + 1` and stop.
3. Track `r − l + 1`.

Examples → 4, 4. Checked against testing every substring on 400 random cases.

Check from the shortest ending upward so the first hit has the largest start, which moves l the least. Each r does at most 10 lookups of up to 10 letters.

Time: O(n · 100)  
Space: O(total forbidden length)

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
