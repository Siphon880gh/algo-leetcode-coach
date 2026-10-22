## Fractions as keys

1. For r = 4 … n − 3: q = r − 2; for p ≤ q − 2 add (nums[p] / g, nums[q] / g) with g = gcd.
2. For s ≥ r + 2: add the count of the reduced (nums[s], nums[r]).

Examples → 1, 3. Checked against every 4-tuple on 200 random arrays.

Ignoring the gap rule: example 2 → 18 instead of 3.

Time: O(n² log V)  
Space: O(n²)

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
