## Words waiting on letters

Keep 26 buckets of `(word index, position)` iterators. Start each word in the bucket of its first letter.

For each character `c` of `s`:

- Take the whole bucket `c` and empty it.
- For each `(w, p)`: if `p + 1 == len(word)`, count it. Otherwise put `(w, p + 1)` in the bucket of `word[p + 1]`.

Every word advances only when the letter it needs appears, which is exactly the greedy subsequence match. Total work is `|s| + Σ|word|`.

**Binary search alternative:** store the sorted positions of each letter in `s`. For each word, jump with `bisect` to the next position after the current one. O(Σ|word| · log |s|).

Do not run a separate two-pointer check of `s` for every word; that is O(words · |s|). Duplicate words can be memoized, but the bucket method handles them anyway.

Time: O(|s| + Σ|word|)  
Space: O(number of words)

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
