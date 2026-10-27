## Knapsack

1. Options for x: ⌊x / 2^i⌋ · 2^j ≤ sum with cost i + j (keep the cheapest cost per value).
2. f[w] = min(f[w], f[w − y] + cost) for w from sum down.
3. Return f[sum], or −1.

Examples → 3, 2, −1. Matched trying every reachable value per element (found by breadth-first search) on 300 random cases.

Not allowing a multiply after a divide (part I's rule): example 2 → −1 instead of 2.

Time: O(n · S · log V · log S)  
Space: O(S)

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
