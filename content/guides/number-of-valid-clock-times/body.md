## Enumerate each half

1. `H` = number of `h` in 0 … 23 whose two digits match `time[0 … 1]`, where `?` matches anything.
2. `M` = number of `m` in 0 … 59 matching `time[3 … 4]`.
3. Return `H · M`.

Examples → 2, 100, 1440.

Rules per position are easy to slip on: ?3 allows 0, 1 and 2 for the first digit, but ?5 allows only 0 and 1. Trying all 24 and 60 values avoids those cases.

Time: O(24 + 60)  
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
