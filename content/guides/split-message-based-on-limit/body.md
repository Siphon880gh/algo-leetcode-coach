## Room for b parts

1. For `b = 1, 2, …`: if `3 + 2 · digits(b) ≥ limit`, return [].
2. `room = Σ_{a = 1 … b} (limit − 3 − digits(a) − digits(b))`; if `room ≥ len(message)`, fill the parts in order, each as full as allowed, and return them.

Examples → 14 parts from thi<1/14> to ge<14/14>, and [short mess<1/2>, age<2/2>]. Checked against filling every b greedily on 400 random messages.

The first b that fits is the fewest parts, and its last part is never empty, since b − 1 parts would then have fit. Summing the room from scratch for every b costs up to about 10^8 steps; instead update it from b − 1, subtracting one more per earlier part whenever digits(b) grows.

Time: O(n)  
Space: O(n) for the output

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
