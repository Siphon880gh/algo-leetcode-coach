## Every start

1. For each i: clear counts; mx = 0.
2. For j = i … n − 1: add s[j]; mx = max(mx, its count); if mx · distinct = j − i + 1, update the answer.
3. Return the answer.

Examples → 4, 4, 2. Checked against testing every substring on 1,500 random strings.

Requiring every letter to appear exactly once: example 1 → 3 instead of 4 ("abba" has each letter twice).

Time: O(n²)  
Space: O(1) (26 counters)

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
