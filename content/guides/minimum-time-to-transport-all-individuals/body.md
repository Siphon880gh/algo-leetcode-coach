## States

1. Start: everyone at the base, stage 0, time 0.
2. From (mask, stage): for each non-empty subset g ⊆ mask with |g| ≤ k: d = max time in g × mul[stage], stage′ = (stage + ⌊d⌋) mod m.
3. If mask = g, that total is a finish. Otherwise for each r already across: back = time[r] × mul[stage′], push (mask − g + r, (stage′ + ⌊back⌋) mod m).
4. Answer the smallest finish, or −1.

Add a tiny epsilon before taking ⌊d⌋: products like 0.7 × 10 can land just below a whole number in floating point.

Examples → 5.00, 14.50, −1. Checked against trying every trip sequence on 150 small cases.

Ignoring the stage (always using mul[0]): example 2 → 15.00 instead of 14.50.

Time: O(m · 3^n · n · log(m · 2^n))  
Space: O(m · 2^n)

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
