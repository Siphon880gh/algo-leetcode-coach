For each of several data centers you are given how many servers it has, the cost to upgrade one server, what selling one server brings, and the money it starts with. Selling servers adds money and each upgrade costs money. For each center, return the most servers that can end up upgraded. Limits are in the official statement. _(Restated from memory; limits and examples may differ slightly from the official statement.)_

## Closed form

This assumes sold servers cannot be upgraded and every sale and upgrade uses the center’s fixed prices; check the official statement.

1. x = ⌊(count · sell + money) / (upgrade + sell)⌋, capped at count.

Constructed checks (run in code): counts [4, 3], upgrade [3, 5], sell [4, 2], money [8, 9] → [3, 2]; 300 random centers match trying every x.

Forgetting the sales gives ⌊money / upgrade⌋: [2, 1] on that check. count · sell can pass 32 bits when the limits are large; use 64-bit.

Time: O(n)  
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
