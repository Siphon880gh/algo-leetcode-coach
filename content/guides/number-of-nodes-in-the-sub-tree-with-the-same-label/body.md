## Merge child counts

1. Undirected adjacency; DFS from 0 with a parent.
2. `cnt = Σ child counts`; `cnt[label[u]] += 1`; `ans[u] = cnt[label[u]]`.

n = 7, labels `"abaedcd"` → `[2,1,1,1,1,1,1]`. `"bbbb"` on edges `[[0,1],[1,2],[0,3]]` → `[4,2,1,1]`. `"aabab"` → `[3,2,1,1,1]`.

Do not run a fresh DFS per node (O(n²)). With n up to 10^5 on a path, use an iterative DFS or raise the recursion limit.

Time: O(26 · n)  
Space: O(26 · n) worst case, or O(26 · height) when reusing a global count with before/after differences

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
