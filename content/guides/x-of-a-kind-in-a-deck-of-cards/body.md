## Every count must split evenly

1. Count each card value.
2. `g = gcd` of all counts.
3. Return `g ≥ 2`.

If some `X ≥ 2` divides every count, then `g` is a multiple of `X`, so `g ≥ 2`. Conversely, `X = g` works.

Trying every X from 2 to n also works, but the gcd is simpler and faster. Do not use the minimum count as X; counts 4 and 6 work with X = 2 even though 4 does not divide 6.

Time: O(n + distinct · log n)  
Space: O(distinct)

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
