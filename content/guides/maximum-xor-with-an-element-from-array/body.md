## Offline insertion by limit

1. Sort `nums`; sort query indices by `m`.
2. For each query: insert every `nums[j] ≤ m` not yet inserted.
3. If the trie is empty → −1; else walk from bit 29 down, preferring the child with bit opposite to `x`.

`[0,1,2,3,4]`, `[[3,1],[1,3],[5,6]]` → `[3,3,7]`. `[5,2,4,6,6,3]`, `[[12,4],[8,1],[6,3]]` → `[15,-1,5]`.

An online alternative stores the minimum value under each trie node and refuses branches whose minimum exceeds m. Do not scan all nums per query (O(n · q)).

Time: O((n + q) · 30 + n log n + q log q)  
Space: O(n · 30)

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
