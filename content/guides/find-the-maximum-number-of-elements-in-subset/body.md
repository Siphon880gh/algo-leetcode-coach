## Chains of squares

1. cnt = counts. For 1: best = cnt[1] if odd, else cnt[1] − 1.
2. For each other x: t = 0, v = x; while cnt[v] ≥ 2: t += 1, v = v². If cnt[v] ≥ 1, length 2t + 1, else 2t − 1.
3. Return the max (at least 1).

Examples → 3, 1. Checked against trying every chain on 2,000 random arrays.

The ones must be odd in number: [1, 1, 1, 1] → 3. Chains are short: values stay at most 10^9, so after about five squarings v exceeds every value.

Time: O(n log log max)  
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
