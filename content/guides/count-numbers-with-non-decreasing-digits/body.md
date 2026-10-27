## Count up to N

1. digits = N in base b.
2. f(i, last, tight) = Σ f(i + 1, d, tight and d = limit) for d from last to limit; 1 at the end.
3. Answer (f(r) − f(l − 1)) mod 10^9 + 7.

Examples → 3, 2. Checked against direct counting on 300 random ranges.

Subtracting f(l) instead of f(l − 1): example 1 → 2 instead of 3.

Time: O(len · b²)  
Space: O(len · b)

> [!ui-builder] Mini game
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a mini-game in this Leetcode Practice Coach IDE app that teaches [INPUT_TOPIC]. Place it under content/games/[INPUT_SLUG]/. Follow meta.php + index.html. Use .agents/skills/game-development-sickn33 for web/2d craft if needed.

> [!ui-builder] Step-by-step
> INPUT_TOPIC: Theory or problem
> INPUT_SLUG: Folder slug (kebab-case)
> PROMPT:
> Use the harness skill at .agents/skills/harness to create a step-by-step session for [INPUT_TOPIC] under content/coaching/[INPUT_SLUG]/. Include branching choices with clear labels, at least one wrong-path leaf with rewind_to, and a success leaf. Follow the tree.php contract so Step back and the Path visualizer work.
