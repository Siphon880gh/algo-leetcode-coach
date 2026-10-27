## Sorted order groups children

1. Sort `folder`.
2. For each path: if the result is empty or the path does not start with `last + "/"`, keep it.
3. Return the kept paths.

`["/a","/a/b","/c/d","/c/d/e","/c/f"]` → `["/a","/c/d","/c/f"]`. `["/a/b/c","/a/b/ca","/a/b/d"]` keeps all three.

A trie of path parts works too.

Do not test `startswith(last)` without the slash; `"/a/b/ca"` is not inside `"/a/b/c"`. Do not compare against every kept path; after sorting only the last one matters.

Time: O(n · L log n)  
Space: O(n · L)

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
