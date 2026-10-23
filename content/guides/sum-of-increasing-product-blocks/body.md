Write the positive integers in order and cut them into blocks: the first block holds 1 number, the second the next 2, the third the next 3, and so on. Each block’s value is the product of its numbers. Return the sum of the first n block values modulo 10^9 + 7. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Simulate

1. nxt = 1; total = 0.
2. For i = 1 … n: p = product of nxt … nxt + i − 1 (mod 10^9 + 7); total += p; nxt += i.
3. Return total.

Assumed here: n is small enough for the n(n + 1)/2 multiplications.

Constructed checks (made-up values, run in code): n = 1 → 1; n = 2 → 7; n = 4 → 5167.

Restarting block i at i: n = 4 → 907 instead of 5167.

Time: O(n²)  
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
