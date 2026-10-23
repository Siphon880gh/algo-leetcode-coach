## Knapsack

1. f[0] = 0, other f[w] = ∞.
2. For each x, for w from sum down to 1, for each option (y, i) with y ≤ w: f[w] = min(f[w], f[w − y] + i).
3. Return f[sum], or −1.

Examples → 3, 3, −1. Matched trying every reachable value per element (found by breadth-first search) on 300 random cases.

Dividing with rounding up: example 1 → 4 instead of 3.

Time: O(n · S · log S)  
Space: O(S)

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
