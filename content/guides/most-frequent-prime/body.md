## Enumerate paths

1. For each cell and direction: v = 0; step while inside: v = 10 v + digit; if v > 10 and v is prime, cnt[v] += 1.
2. If cnt is empty return −1; else the largest v with the top count.

Examples → 19, −1, 97.

Only primes above 10 count: allowing one-digit primes gives example 2 → 7 instead of −1. Break ties toward the largest: the smallest gives example 3 → 47 instead of 97. At most 36 cells · 8 directions · 6 digits, and each number is below 10^6, so trial division is enough.

Time: O(m n · 8 · max(m, n) · √V)  
Space: O(number of primes seen)

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
