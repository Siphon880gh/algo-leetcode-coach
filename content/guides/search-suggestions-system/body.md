## Sorted products

1. Sort `products`.
2. For each prefix `p` of `searchWord`: `i = bisect_left(products, p)`; collect `products[i:i + 3]` that start with `p`.

The sorted order gives the lexicographically smallest matches first. A trie storing the three smallest words per node works too.

`["mobile","mouse","moneypot","monitor","mousepad"]`, `"mouse"` → `"m"` and `"mo"` give `["mobile","moneypot","monitor"]`; `"mou"` onward gives `["mouse","mousepad"]`.

Do not filter all products for every prefix; that is O(L · n · len). Do not forget to check the prefix on all three candidates; the list can run past the matches.

Time: O(n log n + L · log n)  
Space: O(1) besides sorting and the output

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
