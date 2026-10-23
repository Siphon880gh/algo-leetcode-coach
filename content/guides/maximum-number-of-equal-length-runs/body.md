You get a lowercase string. A run is a maximal block of one repeated letter. Choose as many runs as you can such that all chosen runs have the same length, and return how many you chose. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Run lengths

1. Walk s and record each run’s length.
2. Return the largest frequency among the lengths.

Constructed checks (made-up values, run in code): "aabbcdd" → 3; "xyyyxzzz" → 2; "q" → 1.

Counting runs per letter instead of per length: "aabbcdd" → 1 instead of 3.

Time: O(n)  
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
