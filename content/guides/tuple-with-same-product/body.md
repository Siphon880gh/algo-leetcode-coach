## Pairs of pairs

1. `cnt[a[i] · a[j]] += 1` for all `i < j`.
2. Answer `Σ 8 · c(c − 1)/2`.

`[2,3,4,6]` → 8 (2·6 = 3·4). `[1,2,4,5,10]` → 16 (products 10 and 20 each twice).

Values are distinct, so pairs with equal products use four different numbers. The factor 8 covers swapping within each pair and swapping the pairs.

Time: O(n²)  
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
