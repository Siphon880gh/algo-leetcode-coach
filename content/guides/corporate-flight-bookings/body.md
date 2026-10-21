## Range updates in O(1)

1. `diff = [0] · (n + 1)`. For each `[first, last, seats]` (1-indexed): `diff[first − 1] += seats`, `diff[last] −= seats`.
2. Prefix-sum `diff` over the first `n` entries; that is the answer.

The extra slot at index `n` absorbs updates that end at the last flight.

Do not add seats flight by flight for each booking; that is O(bookings · n). Do not mix up the 1-indexed flights with 0-indexed arrays.

Time: O(n + bookings)  
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
