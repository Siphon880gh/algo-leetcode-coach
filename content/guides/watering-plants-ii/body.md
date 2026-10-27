## Simultaneous walk

1. `i = 0`, `j = n − 1`, `a = capacityA`, `b = capacityB`, `refills = 0`.
2. While `i < j`: if `a < plants[i]`, refill A; `a −= plants[i]`. Same for B at `j`. `i += 1`, `j −= 1`.
3. If `i == j` and `max(a, b) < plants[i]`, one more refill.

Examples → 1, 2, 0.

Refills are instantaneous and both always move one plant per step, so only the shared middle plant needs the tie rule; whoever waters it refills when `max(a, b)` falls short.

Time: O(n)  
Space: O(1)

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
