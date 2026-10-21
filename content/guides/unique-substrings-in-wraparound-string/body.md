## A valid substring is its last letter plus a length

Inside `base`, each letter is followed by the next one (with `z` → `a`). So a valid substring is completely determined by its last letter and its length: ending at `c` with length `L` means the `L` letters before and including `c` in alphabet order. If the longest valid run ending at `c` has length `L`, then every shorter one ending at `c` also exists, and they are all distinct.

Walk `s` with `k` = length of the current valid run: if `(s[i] − s[i − 1]) mod 26 == 1`, `k += 1`, else `k = 1`. Set `best[s[i]] = max(best[s[i]], k)`. The answer is the sum of `best` over the 26 letters. Taking the max per letter removes duplicates automatically.

Longest Substring Without Repeating Characters (3) is a different window rule. Counting every substring and storing it in a set is O(n²) memory.

Do not add `k` at every step — the same substring can appear many times. Do not forget the `z` → `a` wrap.

Time: O(n)  
Space: O(1) (26 counters)

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
