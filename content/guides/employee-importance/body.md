## A tree hidden in a list

1. Build `byId[e.id] = e` so you can find each subordinate in O(1).
2. DFS from `id`: `total(e) = e.importance + Σ total(byId[s]) over e.subordinates`.

Each employee has at most one direct leader, so the reporting structure is a forest. Every employee is visited at most once, and no visited set is needed.

BFS with a queue gives the same sum and avoids deep recursion.

Do not search the list for each subordinate; that is O(n²). Do not count only direct reports; indirect subordinates count as well.

Time: O(n)  
Space: O(n)

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
